import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';
import { post } from 'selenium-webdriver/http';

@Component({
  selector: 'app-driver-active-post',
  templateUrl: './driver-active-post.component.html',
  styleUrls: ['./driver-active-post.component.css']
})
export class DriverActivePostComponent implements OnInit {

  postList: Post[] =[];

  constructor(
    private postrequestService: PostRequestService,
    private router: Router
  ) { }

  ngOnInit() {
    this.getActivePostList();
  }

  getActivePostList(){
    let post_userid = localStorage.getItem('currentUserId');
    this.postrequestService.getActivePostByUser(post_userid).pipe(first()).subscribe(postList => {
      this.postList = postList;
    });
  }

}
