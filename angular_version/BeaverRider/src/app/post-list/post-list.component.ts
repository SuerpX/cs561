import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';



@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.css']
})
export class PostListComponent implements OnInit {

  postList: Post[] = [];
  currentUserId: string;

  matchForm: FormGroup;
  loading = false;
  submitted = false;

  constructor(
    private postrequestService: PostRequestService,
    private router: Router,
    private formBuilder: FormBuilder
    ) { }

  ngOnInit() {
    this.matchForm = this.formBuilder.group({
      departure_city: ['', Validators.required],
      departure_state: ['', Validators.required],
      destination_city: ['', Validators.required],
      destination_state: ['', Validators.required],
    });
    this.getPostList();
    this.currentUserId = localStorage.getItem('currentUserId');
  }
  get f() { return this.matchForm.controls; }

  getPostList(){
    this.postrequestService.getPostList().pipe(first()).subscribe(postList => {
      this.postList = postList;
    });
  }

  onSubmit() {
    this.submitted = true;

    if (this.matchForm.invalid) {
        console.log(this.matchForm.value);
        
        return;
    }
    console.log("onsubmit");
    
    this.postrequestService.getPostListBycondition(this.matchForm.value.departure_state, this.matchForm.value.destination_state, this.matchForm.value.departure_city, this.matchForm.value.destination_city).pipe(first()).subscribe(postList => {
        this.postList = postList;
        console.log(this.postList);
        
      });
    
    }

}
