<div>

    <x-dropdown_para_notifications align="right" width="100">

                    <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button wire:click="display_notifications" type="button" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <i class="fas fa-bell" style="font-size: 20px"></i>
                                    @if ($doesnt_viewed>0)
                                        <div class="p-1" style="width:18px;height:18px;position:absolute;left:25px;bottom:13px;border-radius:15px;background-color:red;border:2px solid white;">
                                            <p style="font-size:10px;font-weight:bold;margin-top:-4px;margin-left:px;color:white">{{"$doesnt_viewed"}}</p>
                                        </div>
                                    @endif
                                    {{-- <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"> --}}
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                
                                </button>
                            </span>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2" style="width:100%;word-wrap: break-word;max-height:250px;overflow:scroll;overflow-x: hidden;">
                            @foreach ($notifications as $notification)

                                            <!-- Si es una notifiación de un post -->
                                            @if($notification->notificationable_type == "App\Models\Post")
                                                <a href="{{route("posts.show", [$notification->notificationable->id, $notification->notificationable->name])}}" style="text-decoration: none;color:black">
                                                <div id="notification" class="p-2 col mb-1" style="overflow:hidden">
            
                                                <div style="float:left;width:100%;margin-right:30px">
                                                
                                                <div style="width:50%;float:left;">
                                                    <img id="notification_cover" src="{{$notification->notificationable->cover}}" style="margin-top:22px;height:70px;border-radius:5px;">
                                                </div>

                                                <div style="width:40%;float:right;margin-top:15px">
                                                    <p id="notification_name" style="font-size: 13px">
                                                       User a creado un nuevo post:
                                                    </p>
                                                    <p id="notification_name" style="font-size: 13px">
                                                        "{{$notification->notificationable->name}}"
                                                    </p>
                                                </div>

                                                </div>
                                                </div>
                                                </a>
                                            <!-- Si no, (o sea es una notifiación de un comentario/respuesta) -->    
                                            @elseif($notification->notificationable_type == "App\Models\Comment")                              
                                                <a href="{{route("posts.show", [$notification->notificationable->post->id, $notification->notificationable->post->name])}}" style="text-decoration: none;color:black">
                                                <div id="notification" class="p-2 col mb-1" style="overflow:hidden">
            
                                                <div style="float:left;width:100%;margin-right:30px">

                                                    <div style="width:50%;float:left;">
                                                        <img id="notification_cover" src="{{$notification->notificationable->post->cover}}" style="margin-top:22px;height:70px;border-radius:5px;">
                                                    </div>
                                                    
                                                    <div style="width:40%;float:right;margin-top:15px">
                                                        <p id="notification_name" style="font-size: 12px" >
                                                            <span style="font-weight: bold">{{$notification->notificationable->user->name}}</span>
                                                            ha comentado tu post: 
                                                            <span style="color:rgb(0, 140, 255);">{{$notification->notificationable->post->name}}</span>
                                                        </p>
                                                        <p id="notification_name" class="">
                                                            "{{$notification->notificationable->message}}"
                                                        </p>
                                               
                                                    </div>
 
                                                </div>
                                                </div>
                                                </a>

                                            @endif


                                <hr>
                            @endforeach
                        </div> 
                    </x-slot>

                    
    </x-dropdown_para_notifications>




</div>
