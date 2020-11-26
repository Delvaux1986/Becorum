<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Notifications\newCommentPosted;
use Illuminate\Notifications\DatabaseNotification;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        $topics = Topic::with('user')->latest()->paginate(5);
        return view('topics.index', compact('topics'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
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
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
        $topic = Auth::user()->topics()->create([
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }
    // Show from NOTIF GET TOPIC FROM ROUTE & NOTIF 
    public function showFromNotification(Topic $topic ,DatabaseNotification $notification){
        // dd(Auth::user()->unreadNotifications);
        // DB::table('notifications')->where('id', $notification->id)->update(['read_at' => 'datetime']);
        $notification->markAsRead();
        
        return view('topics.show', compact('topic'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update' , $topic);

        return view('topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update' , $topic);
        $data = $request->validate([
            'title'=>'min:5',
            'content'=>'min:10'
        ]);
        $topic->update($data);

        return redirect()->route('topics.show', $topic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete' , $topic);
        Topic::destroy($topic->id);
        
        return redirect()->route('topics.index');
    }
    
}
