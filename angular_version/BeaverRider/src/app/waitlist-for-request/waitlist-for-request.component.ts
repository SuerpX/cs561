import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { AlertService, PostRequestService } from '../_services';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-waitlist-for-request',
  templateUrl: './waitlist-for-request.component.html',
  styleUrls: ['./waitlist-for-request.component.css']
})
export class WaitlistForRequestComponent implements OnInit {

  requestfrominvite: Post[] = [];
  requestfromjoin: Post[] = [];
  requestid: string;

  constructor(private alertService: AlertService, private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute  ) { }

  ngOnInit() {
    this.requestid = this.route.snapshot.paramMap.get('orderid');
    this.getRequestFromInvite();
    this.getRequestFromJoin();
  }

  getRequestFromInvite(){
    this.postrequestService.getRequestListfromInvite(this.requestid).pipe(first()).subscribe(postList => {
      console.log("getRequestListfromInvite");
      
      console.log(this.requestid);
      
      console.log(postList);
      this.requestfrominvite = postList;
    });
  }

  getRequestFromJoin(){
    this.postrequestService.getRequestListfromJoin(this.requestid).pipe(first()).subscribe(postList => {
      console.log(postList);
      this.requestfromjoin = postList;
    });
  }

  confirm(postid: string){
    this.postrequestService.confirmconnect(postid, this.requestid)
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
