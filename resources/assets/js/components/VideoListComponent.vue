<template>
    <div class="video-list">
			<b-container fluid class="p-4 bg-light clearfix">

				<b-col v-for="video in videos" class="col-sm-4 float-left" v-bind:key="video.id">
					<b-img thumbnail fluid :src="video.featured_image_url" alt="" v-on:click="onSelectVideo(video)"/>
					<div> {{ video.name }}</div>
				</b-col>

			</b-container>

	    	<b-pagination size="md" :total-rows="totalRows" v-model="currentPage" :per-page="perPage" v-on:input="load_page">
    		</b-pagination>
  </div>
</template>

<script>
    export default {
		data: function(){
			return {
				last_page: 1,
				totalRows: 0,
				currentPage: 1,
				perPage: 9,
				videos:[]
			}
		},
		created(){
			this.load_page();
		},
        mounted() {

        },
        methods: {
			onSelectVideo(video){
				if(this.$parent.$parent.$options.methods.onSelectVideo)
				{
					this.$parent.$parent.$options.methods.onSelectVideo(video)
				}	
			},
			load_page(){
				axios.get("/api/videos/featured?&page=" + this.currentPage).then(function(response){
					return response.data;
				}).then((payload)=>{
					this.videos = payload.data;
					this.last_page = payload.meta.last_page;
					this.perPage = payload.meta.per_page;
					this.totalRows = payload.meta.total;
				});

			}
		}
    }
</script>
