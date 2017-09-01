@if(isset($menus))
    <ul>
        @foreach($menus as $menu)
            <li>
                <a href="{{$menu->slug}}">{{$menu->title}}</a>
            </li>
        @endforeach
    </ul>
@endif