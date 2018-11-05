import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';

import { AlertService, PostRequestService } from '../_services';
import { Post } from '../_models';

@Component({
  selector: 'app-new-post',
  templateUrl: './new-post.component.html',
  styleUrls: ['./new-post.component.css']
})
export class NewPostComponent implements OnInit {

    postForm: FormGroup;
    loading = false;
    submitted = false;
    newPost: Post;

  constructor(
        private formBuilder: FormBuilder,
        private router: Router,
        private postrequestservice: PostRequestService,
        private alertService: AlertService
  ) { }

  ngOnInit() {
      this.postForm = this.formBuilder.group({
        post_orderid: [''],
        post_userid: [''],
        departure_location: ['', Validators.required],
        destination_location: ['', Validators.required],
        departure_time: ['', Validators.required],
        post_time: [''],
        remarks: ['', Validators.required],
        available_seats: [null, Validators.required],
        available: [],
        finished: [],
        waitlist: [],
        acceptlist: []
      });
  }

  get f() { return this.postForm.controls; }

  onSubmit() {
    this.submitted = true;

    let postDate = new Date();
    this.postForm.value.post_time = postDate.toLocaleString()
    this.postForm.value.post_userid = localStorage.getItem('currentUserId');
    // stop here if form is invalid
    if (this.postForm.invalid) {
        return;
    }

    //console.log('profileForm.value')
    //console.log(this.profileForm.value);
    //this.postForm.value.finishRegister = 1;

    this.loading = true;
    this.postrequestservice.insertPost(this.postForm.value)
        .pipe(first())
        .subscribe(
            success => {
                this.alertService.success('inseat post successful', true);
                console.log('inseat successful');
                this.router.navigate(['']);
                //this.postForm.value.finishRegister = 1;
            },
            error => {
                this.alertService.error(error);
                console.log('inseat err');
                this.loading = false;
                this.router.navigate(['']);
                //this.postForm.value.finishRegister = 1;
            });
}

}
