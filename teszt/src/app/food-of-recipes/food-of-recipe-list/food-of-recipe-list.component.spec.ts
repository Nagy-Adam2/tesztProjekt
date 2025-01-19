import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FoodOfRecipeListComponent } from './food-of-recipe-list.component';

describe('FoodOfRecipeListComponent', () => {
  let component: FoodOfRecipeListComponent;
  let fixture: ComponentFixture<FoodOfRecipeListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FoodOfRecipeListComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FoodOfRecipeListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
