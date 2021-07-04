<template>
    <div class="tvc">
		<h2>Yêu làn da, thoả sức sống</h2>
		<video width="" height="" controls poster="/images/poster.png">
		  <source v-bind:src="vid" type="video/mp4">
		  <source src="#" type="video/ogg">
		  Your browser does not support the video tag.
		</video>
	</div>
</template>

<script>
export default {
    props: ['vid'],
}
</script>
