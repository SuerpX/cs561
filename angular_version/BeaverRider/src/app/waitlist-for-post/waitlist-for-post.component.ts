import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { AlertService, PostRequestService } from '../_services';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-waitlist-for-post',
  templateUrl: './waitlist-for-post.component.html',
  styleUrls: ['./waitlist-for-post.component.css']
})
export class WaitlistForPostComponent implements OnInit {

  inviterequestwaitlist: Request[] = [];
  joinpostwaitlist: Request[] = [];
  postid: string;

  constructor(private alertService: AlertService, private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute  ) { }

  ngOnInit() {
     this.postid = this.route.snapshot.paramMap.get('postid');
     this.getInvitePostList();
     this.getJoinPostList();
  }

  getInvitePostList(){
    this.postrequestService.getInviteRequestWaitlist(this.postid).pipe(first()).subscribe(requestList => {
      this.inviterequestwaitlist = requestList;
    });
  }

  getJoinPostList(){
    this.postrequestService.getJoinPostWaitlist(this.postid).pipe(first()).subscribe(requestList => {
      this.joinpostwaitlist = requestList;
    });
  }

  confirm(requestid: string){
    this.postrequestService.confirmconnect(this.postid, requestid)
    .pipe(first())
    .subscribe(
        success => {
            this.alertService.success('confrim successful', true);
            console.log('confrim successful');
            this.router.navigate(['']);
            //this.postForm.value.finishRegister = 1;
        },
        error => {
            this.alertService.error(error);
            console.log('confrim err');
            this.router.navigate(['']);
            //this.postForm.value.finishRegister = 1;
        });
  }

}
