import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { AlertService, PostRequestService } from '../_services';

@Component({
  selector: 'app-post-detail',
  templateUrl: './post-detail.component.html',
  styleUrls: ['./post-detail.component.css']
})
export class PostDetailComponent implements OnInit {

  postDetail: Post;

  constructor(private post_requestService: PostRequestService, private router: Router, private alertService: AlertService, private route: ActivatedRoute) { }

	ngOnInit() {
		this.getPostDetail();
		console.log(this.postDetail);
	}

	getPostDetail(){
		let orderid = this.route.snapshot.paramMap.get('orderid');
		//console.log(orderid);
		this.post_requestService.getPostDetail(orderid).pipe(first()).subscribe(post => {
			this.postDetail = post;
			console.log(this.postDetail);
		});
	}

	postDelete(){
		let orderid = this.route.snapshot.paramMap.get('orderid');
		this.post_requestService.deletePost(orderid)
			.pipe(first())
			.subscribe(
				success => {
					this.alertService.success('update post successful', true);
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
