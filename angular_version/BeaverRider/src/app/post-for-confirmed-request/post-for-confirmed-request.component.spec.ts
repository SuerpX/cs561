import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PostForConfirmedRequestComponent } from './post-for-confirmed-request.component';

describe('PostForConfirmedRequestComponent', () => {
  let component: PostForConfirmedRequestComponent;
  let fixture: ComponentFixture<PostForConfirmedRequestComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PostForConfirmedRequestComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PostForConfirmedRequestComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
