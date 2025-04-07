@extends('layouts.app')
@section('content')
<p>Lotto home</p>
    @guest
        
    @endguest
@auth
<script>
    const dashboardNumbers = @json($dash);
    const winner_numbers = @json($winner_numbers);
    document.addEventListener("DOMContentLoaded", () => {
        lotto.createDashboardFromNums(dashboardNumbers);
        lotto.createBalls(winner_numbers);
    });
</script>
<div id="wrapper"></div>
<div class="kimutatas">

<p class="title">Kimutatás</p>
<div id="dashboard"></div>
    
@endauth        
</div>
@endsection