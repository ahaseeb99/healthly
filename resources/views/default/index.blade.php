@extends('layout.app')

@section('content')    
<iframe src="https://healthly-landing-5w1d.vercel.app/?loggedIn={{ !Auth::guest() ? 1 : 0 }}" style="width: 100%; height: 100vh; position: fixed; top: 0; left: 0; border: none;" />
@endsection
