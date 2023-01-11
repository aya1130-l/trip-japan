@props([
    'images' => [] {{-- デフォルト値設定 --}}
])

@if(count($images) > 0)
<div class="mt-4">
    <div class="hscroll flex items-center justify-center mt-2">
		<i class="left arrow cursor-pointer fa fa-chevron-left md:mr-10 mr-5 text-gray-500 text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
        <ul class="w-[250px] text-[0px]">
            @foreach($images as $image)
		    <li><img alt="{{ $image->name }}" class="object-contain w-[250px] mt-4" src="{{ asset('storage/images/memory/' . $image->name) }}"></li>
            @endforeach
	    </ul>
		<i class="right arrow cursor-pointer fa fa-chevron-right md:ml-10 ml-5 text-gray-500 text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
    </div>
</div>
@endif

<script>
	const leftelm =document.querySelector('.left');
    leftelm.onclick = function () {
        let ul = leftelm.parentNode.querySelector('ul');
        ul.scrollLeft -= img.clientWidth;//要素の内容が左端からスクロールするピクセル数
      };
      

    const rightelm = document.querySelector('.right');
    rightelm.onclick = function () {
        let ul = rightelm.parentNode.querySelector('ul');
        ul.scrollLeft += img.clientWidth;
      };
</script>

<style>
.hscroll ul {
	overflow:hidden;
	white-space:nowrap;
	scroll-snap-type:x mandatory;
	scroll-behavior:smooth;
}


.hscroll li {
	list-style:none;
	display:inline-block;
}



@media screen and (max-width:480px) {
	.hscroll ul {
		overflow-x:auto;
	}
}
</style>





