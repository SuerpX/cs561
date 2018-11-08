import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { AlertService, PostRequestService } from '../_services';

@Component({
  selector: 'app-request-detail',
  templateUrl: './request-detail.component.html',
  styleUrls: ['./request-detail.component.css']
})
export class RequestDetailComponent implements OnInit {

  requestDetail: Request;

  constructor(
    private postrequestService: PostRequestService,
    private router: Router, private alertService: AlertService, private route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.getRequestDetail();
  }

  getRequestDetail(){
		let orderid = this.route.snapshot.paramMap.get('orderid');
		this.postrequestService.getRequestDetail(orderid).pipe(first()).subscribe(request => {
			this.requestDetail = request;
		});
  }
  
  requestDelete(){
		let orderid = this.route.snapshot.paramMap.get('orderid');
		this.postrequestService.deleteRequest(orderid)
			.pipe(first())
			.subscribe(
				success => {
					this.alertService.success('update request successful', true);
					console.log('delete successful');
					this.router.navigate(['']);
					//this.postForm.value.finishRegister = 1;
				},
				error => {
					this.alertService.error(error);
					console.log('delete err');
					//this.loading = false;
					this.router.navigate(['']);
					//this.postForm.value.finishRegister = 1;
				});
	}

}
