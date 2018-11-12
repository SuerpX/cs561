import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WaitlistForPostComponent } from './waitlist-for-post.component';

describe('WaitlistForPostComponent', () => {
  let component: WaitlistForPostComponent;
  let fixture: ComponentFixture<WaitlistForPostComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WaitlistForPostComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WaitlistForPostComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
