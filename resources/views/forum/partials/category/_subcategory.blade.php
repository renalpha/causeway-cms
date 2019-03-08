<tr>
    <td title="No unread posts" class="expand footable-visible footable-first-column"><span class="footable-toggle"></span>
        <span class="icon-wrapper">
                             <i class="row-icon-font icon-moon-default forum-read" title="No unread posts"></i>
                            </span>
        <i class="row-icon-font-mini " title="No unread posts"></i>
        <a class="btn-rss pull-right hidden-xs hidden-sm" title="" href="http://www.sitesplat.com/demo/phpBB3/feed.php?f=2"
           data-original-title="Feed - Your first forum"><i class="fa fa-rss rss-color-forum"></i></a> <span class="desc-wrapper">
                        <a href="./viewforum.php?f=2&amp;sid=8f6049e8ed25d252a57d5ad44830afd7" class="forumtitle" data-original-title="" title="">{{ $category->title }}</a><br>
                        <span class="description">{{ $category->description }}</span><br>											  </span>
    </td>
    <td class="stats-col footable-visible">
                         <span class="stats-wrapper">
                         10&nbsp;Topics&nbsp;<br>17&nbsp;Posts
			 			 </span>
    </td>
    <td class="footable-visible footable-last-column">
        			  <span class="last-wrapper text-overflow">
                            <a href="./viewtopic.php?f=2&amp;p=68&amp;sid=8f6049e8ed25d252a57d5ad44830afd7#p68" title="" class="lastsubject" data-original-title="">Re: Responsive Images</a><br/>
								by&nbsp;<a href="./memberlist.php?mode=viewprofile&amp;u=221&amp;sid=8f6049e8ed25d252a57d5ad44830afd7" class="username" data-original-title="" title="">deliac</a>
				            <a class="moderator-item" href="./viewtopic.php?f=2&amp;p=68&amp;sid=8f6049e8ed25d252a57d5ad44830afd7#p68" title="" data-original-title="View the latest post"><i
                                        class="mobile-post fa fa-sign-out"></i></a><br/>
                          <span class="forum-time">{{ cmsDateTime($category->threads->last()->created_at ?? null) }}</span>
                      </span>
    </td>
</tr>