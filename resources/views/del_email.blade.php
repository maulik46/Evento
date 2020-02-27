<h1><strong>{{ $name  }}</strong></h1>
<pre>
Dear <b>{{ucfirst($reciever)}}</b>,
I'm really sorry to inform you that <b>{{ucfirst($ename)}}</b>, which was scheduled on <b>{{date('d-m-Y',strtotime($edate))}}</b>, has been cancelled due to <b>{{ucfirst($reason)}}</b>. Please accept my apologies with regards to this unfortunate matter.

I regret any inconvenience this may cause you, even though I've tried my best to inform everyone as soon as possible.

I appreciate your understanding.

Best Regards,
{{Session::get('aname')}}
{{Session::get('clgname')}}
</pre>
