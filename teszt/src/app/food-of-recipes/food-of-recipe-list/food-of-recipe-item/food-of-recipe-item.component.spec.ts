import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FoodOfRecipeItemComponent } from './food-of-recipe-item.component';

describe('FoodOfRecipeItemComponent', () => {
  let component: FoodOfRecipeItemComponent;
  let fixture: ComponentFixture<FoodOfRecipeItemComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FoodOfRecipeItemComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FoodOfRecipeItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
