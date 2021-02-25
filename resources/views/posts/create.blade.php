<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <body>
        <div class="col-md-12"><br>
            <form action="{{route('posts.store')}}" method="POST">

                @csrf

                <div style="width: 64%;margin:auto">
                    <div class="row d-flex justify-center mt-9 p-10" style="margin-bottom:60px;background-color:white;border-radius:15px 15px 15px 15px;">

                        <div class="form-group col-md-6">
                            <p><strong>Escribí un título</strong></p>
                            <input class="col-md-10 form-control" name="name" type="text" placeholder="Titulo del Post" value={{old('name')}}>
                            @error('name')
                            {{$message}}
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <p><strong>Seleccioná una categoría</strong></p>
                            @foreach ($categorias as $categoria)
                            <div class="float-left" style="width:125px">
                                <label class="m-auto" for="{{$categoria->name}}">
                                    <input id="{{$categoria->name}}" class="mb-1 mr-1" type="radio" name="category" value="{{$categoria->id}}">{{$categoria->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                
                <div style="width: 64%;margin:auto">
                    <div class="mt-10 row d-flex justify-center p-10" style="margin-bottom:70px;background-color:white;border-radius:15px 15px 15px 15px;">

                        {{-- <div class="form-group col-md-6">
                            <p class=""><strong>Previsualización</strong></p>
                            <div>
                                <img src="" alt="">
                            </div>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <p class=""><strong>Cargá una imagen de portada</strong></p>
                            <label style="display:block" for="cover_url">Cargar mediante url
                                <input class="form-control-file mt-1" name="cover_url" type="text" placeholder="Ingresar url" value={{old('cover_url')}}>
                                @if(isset($failed_image_size)&&$failed_image_size==true)
                                  {{$message_image_size}}
                                @endif
                            </label>

                            {{-- <br><br>
                            <p class="text-center"><strong>ó</strong></p>
                            <br>
                            
                            <p class="mb-1">Seleccionar una imagen</p>
                            <label class="btn btn-primary" style="display:block" 
                                for="cover_file">Cargar Imagen
                                <input id="cover_file" class="form-control pt-1" type="file" name="cover_file" style="display:none" value={{old('cover_file')}}> 
                            </label>
                            <div id="img_seleccionada"><p></p></div> --}}
                            {{-- @error('cover_file')
                            {{$message}}
                            @enderror --}}
                        </div>

                    </div>
                </div>

                <div style="width:65%;margin:auto">
                        
                        <div class="clo-md-12 form-group p-10" style="margin-bottom:70px;background-color:white;border-radius:15px 15px 15px 15px;">
                            <p><strong>Esribí los tags para el post</strong></p>
                            <p><i>-Por ejemplo si el post pertenece a la categoría Deporte los tags podrían ser: AFA, Boca Juniors, Argentina, Riquelme etc.</i></p>

                            
                                <input type="text" id="exist-values" class="tagged form-control" data-removeBtn="true" name="tag_2" value="" placeholder="Add Tag">
                           
  
                            <button class="btn btn-primary" id="clear">clear tags</button>
                            <button hidden class="btn btn-primary" id="get">get taggs</button>

                        </div>

                </div>

                <div class="row d-flex justify-center" style="margin-bottom:100px;background-color:white">
                                    
                    <div class="form-group col-md-8">
                        <div class="form-group col-md-12 mt-20">
                            <p class="text-center"><strong>Crear Post</strong></p>
                            <textarea id="editor" name="body" placeholder="Escribe tu Post..." rows="10" cols="20">
                                    {{old('body')}}
                            </textarea>
                                
                            <script>

                                CKEDITOR.replace( 'editor', {
                                });
                                CKEDITOR.config.toolbar = 'full';
                                CKEDITOR.plugins.addExternal( 'youtube', 'plugins/youtube/youtube/plugin.js' );
                                CKFinder.setupCKEditor();
                                CKEDITOR.config.height = 400;

                            </script>
                        </div> 
                        <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit">Crear Post</button>
                      </div>
                    </div>

                    <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>

                </div>



            </form>

        </div>
    </body>

</x-app-layout>

<script src="{{ asset('js/portada_post.js') }}"></script>

<!-- TAGS SCRIPT -->

<script>
    
// https://github.com/k-ivan/Tags
(function() {

'use strict';

// Helpers
function $$(selectors, context) {
  return (typeof selectors === 'string') ? (context || document).querySelectorAll(selectors) : [selectors];
}
function $(selector, context) {
  return (typeof selector === 'string') ? (context || document).querySelector(selector) : selector;
}
function create(tag, attr) {
  var element = document.createElement(tag);
  if(attr) {
    for(var name in attr) {
      if(element[name] !== undefined) {
        element[name] = attr[name];
      }
    }
  }
  return element;
}
function whichTransitionEnd() {
  var root = document.documentElement;
  var transitions = {
    'transition'       : 'transitionend',
    'WebkitTransition' : 'webkitTransitionEnd',
    'MozTransition'    : 'mozTransitionEnd',
    'OTransition'      : 'oTransitionEnd otransitionend'
  };

  for(var t in transitions){
    if(root.style[t] !== undefined){
      return transitions[t];
    }
  }
  return false;
}
function oneListener(el, type, fn, capture) {
  capture = capture || false;
  el.addEventListener(type, function handler(e) {
    fn.call(this, e);
    el.removeEventListener(e.type, handler, capture)
  }, capture);
}
function hasClass(cls, el) {
  return new RegExp('(^|\\s+)' + cls + '(\\s+|$)').test(el.className);
}
function addClass(cls, el) {
  if( ! hasClass(cls, el) )
    return el.className += (el.className === '') ? cls : ' ' + cls;
}
function removeClass(cls, el) {
  el.className = el.className.replace(new RegExp('(^|\\s+)' + cls + '(\\s+|$)'), '');
}
function toggleClass(cls, el) {
  ( ! hasClass(cls, el)) ? addClass(cls, el) : removeClass(cls, el);
}

function Tags(tag) {

  var el = $(tag);

  if(el.instance) return;
  el.instance = this;

  var type = el.type;
  var transitionEnd = whichTransitionEnd();

  var tagsArray = [];
  var KEYS = {
    ENTER: 13,
    COMMA: 188,
    BACK: 8
  };
  var isPressed = false;

  var timer;
  var wrap;
  var field;

  function init() {

    // create and add wrapper
    wrap = create('div', {
      'className': 'tags-container',
    });
    field = create('input', {
      'type': 'text',
      'className': 'tag-input',
      'placeholder': el.placeholder || ''
    });

    wrap.appendChild(field);

    if(el.value.trim() !== '') {
      hasTags();
    }

    el.type = 'hidden';
    el.parentNode.insertBefore(wrap, el.nextSibling);

    wrap.addEventListener('click', btnRemove, false);
    wrap.addEventListener('keydown', keyHandler, false);
    wrap.addEventListener('keyup', backHandler, false);
  }

  function hasTags() {
    var arr = el.value.trim().split(',');
    arr.forEach(function(item) {
      item = item.trim();
      if(~tagsArray.indexOf(item)) {
        return;
      }
      var tag = createTag(item);
      tagsArray.push(item);
      wrap.insertBefore(tag, field);
    });
  }

  function createTag(name) {
    var tag = create('div', {
      'className': 'tag pt-2',
      'innerHTML': '<span class="tag__name">' + name + '</span>'+
                   '<button class="tag__remove">&times;</button>'
    });
//       var tagName = create('span', {
//         'className': 'tag__name',
//         'textContent': name
//       });
//       var delBtn = create('button', {
//         'className': 'tag__remove',
//         'innerHTML': '&times;'
//       });
    
//       tag.appendChild(tagName);
//       tag.appendChild(delBtn);
    return tag;
  }

  function btnRemove(e) {
    e.preventDefault();
    if(e.target.className === 'tag__remove') {
      var tag  = e.target.parentNode;
      var name = $('.tag__name', tag);
      wrap.removeChild(tag);
      tagsArray.splice(tagsArray.indexOf(name.textContent), 1);
      el.value = tagsArray.join(',')
    }
    field.focus();
  }

  function keyHandler(e) {

    if(e.target.tagName === 'INPUT' && e.target.className === 'tag-input') {

      var target = e.target;
      var code = e.which || e.keyCode;

      if(field.previousSibling && code !== KEYS.BACK) {
        removeClass('tag--marked', field.previousSibling);
      }

      var name = target.value.trim();

      if(code === KEYS.ENTER || code === KEYS.COMMA) {
      //if(code === KEYS.ENTER) {

        target.blur();

        addTag(name);

        if(timer) clearTimeout(timer);
        timer = setTimeout(function() { target.focus(); }, 10 );
      }
      else if(code === KEYS.BACK) {
        if(e.target.value === '' && !isPressed) {
          isPressed = true;
          removeTag();
        }
      }
    }
  }
  function backHandler(e) {
    isPressed = false;
  }

  function addTag(name) {

    // delete comma if comma exists
    name = name.toString().replace(/,/g, '').trim();

    if(name === '') return field.value = '';

    if(~tagsArray.indexOf(name)) {

      var exist = $$('.tag', wrap);

      Array.prototype.forEach.call(exist, function(tag) {
        if(tag.firstChild.textContent === name) {

          addClass('tag--exists', tag);

          if(transitionEnd) {
            oneListener(tag, transitionEnd, function() {
              removeClass('tag--exists', tag);
            });
          } else {
            removeClass('tag--exists', tag);
          }


        }

      });

      return field.value = '';
    }

    var tag = createTag(name);
    wrap.insertBefore(tag, field);
    tagsArray.push(name);
    field.value = '';
    el.value += (el.value === '') ? name : ',' + name;
  }

  function removeTag() {
    if(tagsArray.length === 0) return;

    var tags = $$('.tag', wrap);
    var tag = tags[tags.length - 1];

    if( ! hasClass('tag--marked', tag) ) {
      addClass('tag--marked', tag);
      return;
    }

    tagsArray.pop();

    wrap.removeChild(tag);

    el.value = tagsArray.join(',');
  }

  init();

  /* Public API */

  this.getTags = function() {
    return tagsArray;
  }

  this.clearTags = function() {
    if(!el.instance) return;
    tagsArray.length = 0;
    el.value = '';
    wrap.innerHTML = '';
    wrap.appendChild(field);
  }

  this.addTags = function(name) {
    if(!el.instance) return;
    if(Array.isArray(name)) {
      for(var i = 0, len = name.length; i < len; i++) {
        addTag(name[i])
      }
    } else {
      addTag(name);
    }
    return tagsArray;
  }

  this.destroy = function() {
    if(!el.instance) return;

    wrap.removeEventListener('click', btnRemove, false);
    wrap.removeEventListener('keydown', keyHandler, false);
    wrap.removeEventListener('keyup', keyHandler, false);

    wrap.parentNode.removeChild(wrap);

    tagsArray = null;
    timer = null;
    wrap = null;
    field = null;
    transitionEnd = null;

    delete el.instance;
    el.type = type;
  }
}

window.Tags = Tags;

})();

// Use
var tags = new Tags('.tagged');

document.getElementById('get').addEventListener('click', function(e) {
e.preventDefault();
alert(tags.getTags());
});
document.getElementById('clear').addEventListener('click', function(e) {
e.preventDefault();
tags.clearTags();
});
document.getElementById('add').addEventListener('click', function(e) {
e.preventDefault();
tags.addTags('New');
});
document.getElementById('addArr').addEventListener('click', function(e) {
e.preventDefault();
tags.addTags(['Steam Machines', 'Nintendo Wii U', 'Shield Portable']);
});
document.getElementById('destroy').addEventListener('click', function(e) {
e.preventDefault();
if(this.textContent === 'destroy') {
  tags.destroy();
  this.textContent = 'reinit';
} else {
  this.textContent = 'destroy';
  tags = new Tags('.tagged');
}

});
</script>