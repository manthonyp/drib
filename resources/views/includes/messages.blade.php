<div id="status">

    @if (count($errors) > 0)

        @foreach ($errors->all() as $error)
    
            <div class="alert alert-darken alert-dismissable">
                <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <i class="fas fa-times mr-2"></i> {{$error}}
            </div>
    
        @endforeach
        
    @endif
    
    @if (session('success'))
    
        <div class="alert alert-darken alert-dismissable">
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <i class="fas fa-check mr-2"></i> {{session('success')}}
        </div>
    
    @elseif (session('error'))
    
        <div class="alert alert-darken alert-dismissable">
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <i class="fas fa-times mr-2"></i></i> {{session('error')}}
        </div>
    
    @endif

</div>
