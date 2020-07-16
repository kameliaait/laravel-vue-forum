<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use App\Rules\Captcha;



class TopicController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $topics = Topic::latest()->paginate(10);
        return view('topic.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $topic= new Topic;
        return view('topic.create',compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
          'title'=>'required|min:5',
         'content'=>'required|min:10',
        // 'g-recaptcha-response'=> new Captcha(),
        ]);
       $topic = Auth()->user()->topics()->create([
         'title'=>request('title'),
         'content'=>request('content')
       ]);
        return redirect()->route('topic.show',$topic->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topic.show',compact('topic'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update',$topic);
        return view('topic.edit',compact('topic'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update',$topic);
        
        $data= $request->validate([
          'title'=>'required|min:5',
         'content'=>'required|min:10',
         'g-recaptcha-response' => new Captcha(),
        ]);
         $topic->update($data);
      return redirect()->route('topic.show',$topic->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete',$topic);

        Topic::destroy($topic->id); 
       return redirect('/');

    }
    public function showFromNotification(Topic $topic, DatabaseNotification $notification){
        $notification->markAsRead();
        return view('topic.show',compact('topic'));
    }
}
