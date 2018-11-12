import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PostListInviteComponent } from './post-list-invite.component';

describe('PostListInviteComponent', () => {
  let component: PostListInviteComponent;
  let fixture: ComponentFixture<PostListInviteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PostListInviteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PostListInviteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
