<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Placement;
use App\User;
use App\DeviceToken;
use Edujugon\PushNotification\PushNotification;
use Storage;
use File;

class PlacementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placements = Placement::with('user')->latest()->paginate(10);
        if(count($placements))
            return view('admin.placements.index', compact('placements'));
        else
            return view('errors.404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where([
            ['status', '=', '1'],
            ['role', '=', 'Placement Coordinator'],
            ])->get();
        return view('admin.placements.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'date' => 'required',
            'issued_by' => 'required',
        ]);

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));

        $placement = new Placement();
        $placement->head = request('head');
        $placement->body = request('body');
        $placement->date = request('date');
        $placement->year = $year;
        $placement->branch = $branch;
        $placement->issued_by = request('issued_by');

        $file_name = array();
        $file_mime = array();
        $original_filename = array();

        if($request->hasFile('attachment'))
        {
            foreach($request->attachment as $file)
            {
                $extension = $file->getClientOriginalExtension();
                array_push($file_name, $file->getFilename().'.'.$extension);
                array_push($file_mime, $file->getClientMimeType());
                array_push($original_filename, $file->getClientOriginalName());
                Storage::put('placements/'.$file->getFilename().'.'.$extension,  File::get($file));            
            }
            
            $placement->file_name = implode(',', $file_name);
            $placement->file_mime = implode(',', $file_mime);
            $placement->original_filename = implode(',', $original_filename);
        }

        $placement->save();        

        $devices = array();
        $result = array();

        foreach($request->year as $year)
        {
            foreach($request->branch as $branch)
            {
                $device = DeviceToken::where([
                    ['year', '=', $year],
                    ['branch', '=', $branch],
                ])->pluck('token')->toArray();
                array_push($devices, $device);
            }
        }
        foreach ($devices as $key => $value) { 
            if (is_array($value)) { 
                $result = array_merge($result, array_flatten($value)); 
            } 
            else { 
                $result[$key] = $value; 
            } 
        }

        
        $push = new PushNotification('fcm');
        $response = $push->setMessage([
                    'notification' => [
                            'title' => $placement->head,
                            'body' => $placement->body,
                            'sound' => 'default'
                            ]
                    ])
                ->setDevicesToken($result)
                ->send();

        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/placements/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $placement = Placement::with('user')->find($id);
        if($placement)
        {
            $attachment = array();
            $file = explode(',', $placement->file_name);
            $size = 0;
            for($i=0; $i<count($file); $i++)
            {
                $bytes = Storage::size('placements/'.$file[$i]);
                if ($bytes > 0)
                {
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
                    $size = number_format($bytes / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                }
                if($size)
                    array_push($attachment, $size);
            }
            $file_name = explode(',', $placement->file_name);
            $original_filename = explode(',', $placement->original_filename);
            return view('admin.placements.view', compact('placement', 'attachment', 'file_name', 'original_filename'));
        }
        else    
            return view('errors.404');
    }

    public function download($id, $file_name)
    {
        $placement = Placement::find($id);
        $filename = explode(',', $placement->file_name);
        $filemime = explode(',', $placement->file_mime);
        $original = explode(',', $placement->original_filename);

        for($i=0; $i<count($filename); $i++)
        {
            if($file_name == $filename[$i])
            {
                $header = [
                    'Content-Type' => $filemime[$i],
                ];
                return response()->download(storage_path('app/placements/'.$file_name), $original[$i], $header); 
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where([
            ['status', '=', '1'],
            ['role' , '=', 'Placement Coordinator']
        ])->get();
        $placement = Placement::find($id);
        if($placement)
        {
            $issued_by = $placement->issued_by;
            $year = explode(',', $placement->year);
            $branch = explode(',', $placement->branch);
            return view('admin.placements.edit', compact('placement', 'year', 'branch', 'users', 'issued_by'));
        }
        else
        {
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'date' => 'required',
            'issued_by' => 'required',
        ]);

        $placement = Placement::find($id);
        if($placement)
        {
            $year = implode(',', $request->get('year'));
            $branch = implode(',', $request->get('branch'));
    
            $placement->head = request('head');
            $placement->body = request('body');
            $placement->date = request('date');
            $placement->year = $year;
            $placement->branch = $branch;
            $placement->issued_by = request('issued_by');

            if($request->hasFile('attachment'))
            {
                $file_name = array();
                $file_mime = array();
                $original_filename = array();
                if($placement->file_name)
                {
                    $file_name = explode(',', $placement->file_name);
                    for($i=0; $i<count($file_name); $i++)
                    {
                        Storage::delete('placements/'.$file_name[$i]);
                    }
                }
                $file_name = array();                
                foreach($request->attachment as $file)
                {
                    $extension = $file->getClientOriginalExtension();
                    array_push($file_name, $file->getFilename().'.'.$extension);
                    array_push($file_mime, $file->getClientMimeType());
                    array_push($original_filename, $file->getClientOriginalName());
                    Storage::put('placements/'.$file->getFilename().'.'.$extension,  File::get($file));            
                }
                $placement->file_name = implode(',', $file_name);
                $placement->file_mime = implode(',', $file_mime);
                $placement->original_filename = implode(',', $original_filename);
            }
    
            $placement->save();
    
            \Session :: flash('update','Updated Successfully!');
            return redirect('/admin/placements/');
        }
        else
        {
            return view('errors.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $placement = Placement::find($id);

        if($placement)
        {
            $placement->status = 0;
            $placement->save();
    
            \Session::flash('delete', 'Deleted successfully.');
            return redirect('admin/placements/');
        }
        else
        {
            return view('errors.404');
        }
    }
}
