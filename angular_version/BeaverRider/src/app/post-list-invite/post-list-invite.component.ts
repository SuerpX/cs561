import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { ActivatedRoute } from '@angular/router';
import { PostRequestService } from '../_services';

@Component({
  selector: 'app-post-list-invite',
  templateUrl: './post-list-invite.component.html',
  styleUrls: ['./post-list-invite.component.css']
})
export class PostListInviteComponent implements OnInit {

  postList: Post[] = [];
  requestid: string;

  constructor(private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.requestid = this.route.snapshot.paramMap.get('requestid');
    this.getPostList();
    localStorage.setItem('requestid', this.requestid);
  }

  postClick(post: Post){
    localStorage.removeItem('requestid');
    this.postrequestService.inviterequest(post.post_orderid, this.requestid, post.post_userid);
    window.location.href="http://web.engr.oregonstate.edu/~hezhi/kun_test/beaverrider"
  }

  getPostList(){
    this.postrequestService.getPostListBycondition().pipe(first()).subscribe(postList => {
      this.postList = postList;
    });
  }

}
