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

  requestList: Request[] = [];
  postid: string;

  constructor(private alertService: AlertService, private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.postid = this.route.snapshot.paramMap.get('postid');
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
    this.postrequestService.getRequestListBycondition().pipe(first()).subscribe(requestList => {
      this.requestList = requestList;
    });
  }

}
