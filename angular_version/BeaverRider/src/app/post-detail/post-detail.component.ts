import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';

@Component({
  selector: 'app-post-detail',
  templateUrl: './post-detail.component.html',
  styleUrls: ['./post-detail.component.css']
})
export class PostDetailComponent implements OnInit {

  postDetail: Post;

  constructor(private post_requestService: PostRequestService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.getPostDetail();
    console.log(this.postDetail);
  }

  getPostDetail(){
    let orderid = this.route.snapshot.paramMap.get('orderid');
    console.log(orderid);
    this.post_requestService.getPostDetail(orderid).pipe(first()).subscribe(post => {
      this.postDetail = post;
      console.log(this.postDetail);
    });
  }
}
