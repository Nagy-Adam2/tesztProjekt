import { Component, OnInit } from '@angular/core';
import { Post } from '../../../shared/models/post';
import { PostService } from '../../../shared/services/post.service';

@Component({
  selector: 'app-message-item',
  templateUrl: './message-item.component.html',
  styleUrl: './message-item.component.less'
})
export class MessageItemComponent {

  public posts: Array<Post>;
  public errorMsg: string;

  isFetching = false;
  loadedPost = false;

  constructor(private postService: PostService) {
    this.posts = [];
    this.errorMsg = '';
  }

  ngOnInit(): void {
    this.booleanPosts();
  }

  booleanPosts() {
    this.isFetching = true;
    const that = this;
    setTimeout(function() {
      that.isFetching = false;
    }, 4000);
    this.loadedPost = true;
    this.fetchPosts();
  }

  fetchPosts() {
    this.postService.getPosts()
    .subscribe(
      data => {
        this.dataPostsIf(data);
      },
      error => {
        this.errorPostsIf(error);
      }
    );
  }

  dataPostsIf(data: any) {
    if (data.length) {
      this.isFetching = false;
      this.loadedPost = false;
    }
    this.posts = data;
  }

  errorPostsIf(error: any) {
    if(error) {
      this.isFetching = false;
      this.loadedPost = false;
    }
    this.errorMsg = error.message;
  }

}
