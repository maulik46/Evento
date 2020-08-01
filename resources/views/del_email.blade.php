<h3><strong>{{ $name  }}</strong></h3>
<div style="font-size:15px;">
Dear <b>{{ucfirst($reciever)}}</b>,
<br>
We are really sorry to inform you that <b>{{ucfirst($ename)}}</b>, which was scheduled on <b>{{date('d-m-Y',strtotime($edate))}}</b>, has been cancelled due to <b>{{ucfirst($reason)}}</b>. Please accept our sincere apologies.
<br>
We accept your interest in this event but unfortunately event is cancelled.We appreciate your understanding but do not worry.You can contact us for upcoming events in future any day.So, Stay connected.
<br>
Best Regards,<br>
{{Session::get('aname')}}<br>
{{Session::get('clgname')}}
</div>
