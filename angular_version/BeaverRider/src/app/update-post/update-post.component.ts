import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { ActivatedRoute } from '@angular/router';
import { AlertService, PostRequestService } from '../_services';
import { Post } from '../_models';



@Component({
	selector: 'app-update-post',
	templateUrl: './update-post.component.html',
	styleUrls: ['./update-post.component.css']
})
export class UpdatePostComponent implements OnInit {

    postForm: FormGroup;
    loading = false;
    submitted = false;
    updatePost: Post;

    constructor(
        private formBuilder: FormBuilder,
    	private router: Router,
        private postrequestservice: PostRequestService,
		private alertService: AlertService,
		private route: ActivatedRoute
    ) { }

    ngOnInit() {
		this.getPostDetailwithform();
		
    }

    get f() { return this.postForm.controls; }

    onSubmit() {
		this.submitted = true;

		//let postDate = new Date();
		//this.postForm.value.post_time = postDate.toLocaleString()
		//this.postForm.value.post_userid = localStorage.getItem('currentUserId');
		// stop here if form is invalid
		if (this.postForm.invalid) {
			return;
		}


		this.loading = true;
		this.postrequestservice.updatePost(this.postForm.value)
			.pipe(first())
			.subscribe(
				success => {
					this.alertService.success('update post successful', true);
					console.log('update successful');
					this.router.navigate(['']);
					//this.postForm.value.finishRegister = 1;
				},
				error => {
					this.alertService.error(error);
					console.log('update err');
					this.loading = false;
					this.router.navigate(['']);
					//this.postForm.value.finishRegister = 1;
				});
	}
	

	getPostDetailwithform(){
		let orderid = this.route.snapshot.paramMap.get('orderid');
		//console.log(orderid);
		this.postrequestservice.getPostDetail(orderid).pipe(first()).subscribe(post => {
			this.updatePost = post;
			this.postForm = this.formBuilder.group({
				post_orderid: [this.updatePost.post_orderid],
				post_userid: [this.updatePost.post_userid],
				departure_location: [this.updatePost.departure_location, Validators.required],
				destination_location: [this.updatePost.destination_location, Validators.required],
				departure_time: [this.updatePost.departure_time, Validators.required],
				post_time: [this.updatePost.post_time],
				remarks: [this.updatePost.remarks, Validators.required],
				available_seats: [this.updatePost.available_seats, Validators.required],
				available: [this.updatePost.available],
				finished: [this.updatePost.finished],
				waitlist: [this.updatePost.waitlist],
				acceptlist: [this.updatePost.acceptlist]
			});
			//console.log(this.updatePost);
		});
	}
}

