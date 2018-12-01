import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { ActivatedRoute } from '@angular/router';
import { AlertService, PostRequestService } from '../_services';

@Component({
  selector: 'app-post-list-invite',
  templateUrl: './post-list-invite.component.html',
  styleUrls: ['./post-list-invite.component.css']
})
export class PostListInviteComponent implements OnInit {

  postList_: Post[] = [];
  postList: Post[] = [];
  requestid: string;
  PostWaitlist: Post[] = [];

  constructor(private alertService: AlertService, private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.requestid = this.route.snapshot.paramMap.get('orderid');
    this.getPostList();
    //localStorage.setItem('requestid', this.requestid);
  }

  postClick(post: Post){
    //localStorage.removeItem('requestid');

    this.postrequestService.inviterequest(post.post_orderid, this.requestid, post.post_userid)
			.pipe(first())
			.subscribe(
				success => {
					this.alertService.success('inviterequest successful', true);
					console.log('inviterequest successful');
				},
				error => {
					this.alertService.error(error);
					console.log('inviterequest err');
        });
    this.router.navigate(['']);
  }

  getPostList(){
    let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getPostListByUserId(currentUserId).pipe(first()).subscribe(postList => {
      this.postList_ = postList;
      this.getPostWaitlist();
    });
  }

  getPostWaitlist(){
    //let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getRequestListfromJoin(this.requestid).pipe(first()).subscribe(requestList => {
      this.PostWaitlist = requestList;

      if (this.PostWaitlist != null){
        this.removeOverlap(this.postList_, this.PostWaitlist)
      }
      else{
        this.postList = this.postList_
        console.log("this.postList = this.postList_");
        
      }

    });
  }

  removeOverlap(l1, l2) {
    console.log(l1);
    console.log(l2);

    for(var i = 0; i < l1.length; i++){
        var flag = 0;
        for(var j = 0; j < l2.length; j++){
          console.log(l1[i].post_orderid);
          console.log(l2[j].post_orderid);
          
          
            if(l1[i].post_orderid == l2[j].post_orderid){
                flag = 1;
                break;
            }

        }
        console.log(i);
        console.log(flag);
        
        
        if (flag == 0){
            this.postList.push(l1[i])
            console.log("push");
            
            console.log(this.postList);
            
        }

    }
    console.log("this.postList");
    
    console.log(this.postList);
    
}

}
