@props([
    'newImagesPath' => []
])

@if(count($newImagesPath) > 0)
<div class="mt-8">
    <div class="hscroll flex items-center justify-center">
		<i class="left arrow cursor-pointer fa fa-chevron-left md:mr-10 mr-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
        <ul class="w-[250px] text-[0px]">
            @foreach($newImagesPath as $newImagePath)
		    <li><img alt="{{ $newImagePath }}" class="object-contain w-[250px] mt-5" src="{{ image_url($newImagePath) }}"></li>
            @endforeach
	    </ul>
		<i class="right arrow cursor-pointer fa fa-chevron-right md:ml-10 ml-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
    </div>
</div>
@endif

<script>
	const leftelm =document.querySelector('.left');
	leftelm.onclick = function () {
			let ul = leftelm.parentNode.querySelector('ul');
			ul.scrollLeft -= ul.clientWidth;
		};
		
	const rightelm = document.querySelector('.right');
	rightelm.onclick = function () {
			let ul = rightelm.parentNode.querySelector('ul');
			ul.scrollLeft += ul.clientWidth;
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