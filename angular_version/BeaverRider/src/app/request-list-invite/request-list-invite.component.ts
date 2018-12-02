import { Component, OnInit } from '@angular/core';import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { ActivatedRoute } from '@angular/router';
import { AlertService, PostRequestService } from '../_services';

@Component({
  selector: 'app-request-list-invite',
  templateUrl: './request-list-invite.component.html',
  styleUrls: ['./request-list-invite.component.css']
})
export class RequestListInviteComponent implements OnInit {

  requestList_: Request[] = [];
  requestList: Request[] = [];
  postid: string;
  requestWaitlist: Request[] = [];

  constructor(private alertService: AlertService, private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.postid = this.route.snapshot.paramMap.get('orderid');
    this.getRequestList();
    
  }

  requestClick(request: Request){
    //localStorage.removeItem('requestid');

    this.postrequestService.joinpost(this.postid, request.request_orderid, request.request_userid)
			.pipe(first())
			.subscribe(
				success => {
					this.alertService.success('joinpost successful', true);
					console.log('joinpost successful');
				},
				error => {
					this.alertService.error(error);
					console.log('joinpost err');
        });
    this.router.navigate(['']);
  }

  getRequestList(){
    let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getRequestListByUserId(currentUserId).pipe(first()).subscribe(requestList => {
      this.requestList_ = requestList;
      this.getRequestWaitlist();
    });
  }

  getRequestWaitlist(){
    //let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getJoinPostWaitlist(this.postid).pipe(first()).subscribe(requestList => {
      this.requestWaitlist = requestList;

      if (this.requestWaitlist != null){
        this.removeOverlap(this.requestList_, this.requestWaitlist)
      }
      else{
        this.requestList = this.requestList_
      }

    });
  }

  removeOverlap(l1, l2) {
    for(var i = 0; i < l1.length; i++){
        var flag = 0;
        for(var j = 0; j < l2.length; j++){
            if(l1[i].request_orderid == l2[j].request_orderid){
                flag = 1;
                break;
            }

        }
        if (flag == 0){
            this.requestList.push(l1[i])
        }

    }
}

}
