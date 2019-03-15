<template>
    <table class="footable table table-striped table-bordered table-white table-hover default footable-loaded">
        <thead>
        <tr>
            <th data-class="expand" class="footable-visible footable-first-column"><i class="fa fa-list-ol"></i> <a
                    href="" data-original-title="" title="">{{ category.title }}</a><br /><span v-html="category.description">{{ category.description }}</span></th>
            <th class="large80 footable-visible" data-hide="phone"><i class="fa fa-bar-chart-o"></i> Statistics</th>
            <th class="large20 footable-visible footable-last-column" data-hide="phone"><i class="fa fa-comments-o"></i> Last post</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="subcategory in category.children">
            <td title="No unread posts" class="expand footable-visible footable-first-column"><span class="footable-toggle"></span>
                <span class="icon-wrapper">
                             <i class="row-icon-font icon-moon-default forum-read" title="No unread posts"></i>
                            </span>
                <i class="row-icon-font-mini " title="No unread posts"></i>
                <a class="btn-rss pull-right hidden-xs hidden-sm" title="" href="http://www.sitesplat.com/demo/phpBB3/feed.php?f=2"
                   data-original-title="Feed - Your first forum"><i class="fa fa-rss rss-color-forum"></i></a> <span class="desc-wrapper">
                        <a :href="subcategory.fqn_slug" class="forumtitle" data-original-title="" title="">{{ subcategory.title }}</a><br>
                        <span class="description" v-html="subcategory.description">{{ subcategory.description }}</span><br>
            </span>
            </td>
            <td class="stats-col footable-visible">
                         <span class="stats-wrapper">
                         {{ subcategory.count_threads }}&nbsp;Topics&nbsp;<br>{{ subcategory.count_replies }}&nbsp;Replies
			 			 </span>
            </td>
            <td class="footable-visible footable-last-column">
        			  <span class="last-wrapper text-overflow">
                            <a href="#" title="" class="lastsubject" data-original-title="">Re: Responsive Images</a><br/>
								by&nbsp;<a href="#" class="username" data-original-title="" title="">deliac</a>
				            <a class="moderator-item" href="#" title="" data-original-title="View the latest post"><i
                                    class="mobile-post fa fa-sign-out"></i></a><br/>
                          <span class="forum-time">My last post date</span>
                      </span>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import Message from './MessageComponent.vue';

    export default {
        mounted() {
            console.log('Forum index mounted.');
        },
        props: ['category'],
        components: {
            Message
        },
        data: function () {
            return {
                loginDetails: {
                    email: '',
                    password: ''
                },
            }
        },
        created() {
            if (this.message) {
                this.flash(this.message)
            }
        },
        methods: {}
    }
</script>
