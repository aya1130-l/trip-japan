@props([
    'images' => [] {{-- デフォルト値設定 --}}
])

@if(count($images) > 0)
<div class="mt-4">
    <div class="hscroll flex items-center justify-center mt-2">
		<i class="left arrow cursor-pointer fa fa-chevron-left md:mr-10 mr-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
        <ul class="w-[250px] text-[0px]">
            @foreach($images as $image)
		      <li><img alt="{{ $image->name }}" class="object-contain w-[250px] mt-4" src="{{ image_url($image->name) }}"></li>
            @endforeach
	    </ul>
		<i class="right arrow cursor-pointer fa fa-chevron-right md:ml-10 ml-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
    </div>
</div>
@endif

<script>
document.querySelectorAll('.left').forEach(elm => {
	elm.onclick = function () {
		let ul = elm.parentNode.querySelector('ul');
		ul.scrollLeft -= ul.clientWidth;
	};
});
document.querySelectorAll('.right').forEach(elm => {
	elm.onclick = function () {
		let ul = elm.parentNode.querySelector('ul');
		ul.scrollLeft += ul.clientWidth;
	};
});
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