<h2>Happy Birthday!</h2>

<p>You have received a birthday greting from {{$greeting->user->name}}!</p>
<p>Click <a href="{{config('app.url') . '/notes/' . $greeting->id}}">here</a> to view it!</p>
