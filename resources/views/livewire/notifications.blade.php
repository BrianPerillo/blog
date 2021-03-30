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
                                <a href="" style="text-decoration: none;color:black">
                                    <div id="notification" class="p-2 col mb-1" style="overflow:hidden">

                                        <div style="float:left;width:100%;margin-right:30px">

                                            <!-- Si es una notifiación de un post -->
                                            @if($notification->notificationable_type == "App\Models\Post")
                                                
                                                <div style="float:left;margin-right:30px"><img id="notification_cover" src="{{$notification->notificationable->cover}}" style="width:140px;height:70px;border-radius:5px;"></div>
                                                <div class="d-flex justify-content-center" style="float:left;margin-top:15px">
                                                    <p id="notification_name">
                                                        {{$notification->notificationable->name}}
                                                    </p>
                                                </div>
                                            
                                            <!-- Si no, (o sea es una notifiación de un comentario/respuesta) -->    
                                            @else                              
                                                <div class="row">

                                                    <div class="col" style="float:left;margin-right:30px">
                                                        <img id="notification_cover" src="{{$notification->notificationable->cover}}" style="margin-top:22px;width:140px;height:70px;border-radius:5px;">
                                                    </div>

                                                    <div class="col" style="float:left;margin-top:15px">
                                                        <p style="font-size: 12px" >
                                                            Han comentado tu post
                                                        </p>
                                                        <p class="" id="notification_name">
                                                            {{$notification->notificationable->message}}
                                                        </p>
                                                </div>
                                                </div>
                                                
                                            @endif

                                        </div>

                                    </div>
                                </a>
                                <hr>
                            @endforeach
                        </div> 
                    </x-slot>

                    
    </x-dropdown_para_notifications>




</div>
