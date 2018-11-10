import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NewPostInviteComponent } from './new-post-invite.component';

describe('NewPostInviteComponent', () => {
  let component: NewPostInviteComponent;
  let fixture: ComponentFixture<NewPostInviteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NewPostInviteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NewPostInviteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
