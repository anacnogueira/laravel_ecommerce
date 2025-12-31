<nav id="menu-dropdown">
    <div id="btn-mobile"> Menu</div>
    <div class="button"></div>
    <ul>
        @foreach ($menu["categories"] as $category)
        <li>
            <a href="/categorias/{{ $category->permalink}}">{{ $category->name }}</a>
            @if(count($category->children) > 0)
                <ul>
                    @foreach ($category->children as $children)
                    <li>
                        <a href="/categorias/{{ $children->permalink}}">{{  $children->name }}</a>

                        @if(count($children->children) > 0)
                            <ul>
                                @foreach ($children->children as $subcategory)
                                    <li>
                                        <a href="/categorias/{{ $subcategory->permalink }}">{{ $subcategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
        <li><a href="/novidades" class="active">Novidades</a></li>
        <li>
            <a href="/marcas">Marcas</a>
            <ul>
                @foreach ($menu['brands'] as $brand)
                    @php
                        $slugName = Str::slug($brand->name,'-');
                        $link = !empty($brand->permalink) ?
                        $brand->permalink :
                        "/" . $brand->id."/".$slug_name;
                    @endphp
                    <li>
                        <a href="/marca{{ $link }}">{{ $brand->name }}</a>
                    </li>
                 @endforeach
            </ul>
        </li>
    </ul>
</nav>
