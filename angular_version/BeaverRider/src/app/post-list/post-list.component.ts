import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';


@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.css']
})
export class PostListComponent implements OnInit {

  postList: Post[] = [];
  currentUserId: string;

  constructor(private postrequestService: PostRequestService, private router: Router ) { }

  ngOnInit() {
    this.getPostList();
    this.currentUserId = localStorage.getItem('currentUserId');
  }

  getPostList(){
    this.postrequestService.getPostList().pipe(first()).subscribe(postList => {
      this.postList = postList;
    });
  }

}
