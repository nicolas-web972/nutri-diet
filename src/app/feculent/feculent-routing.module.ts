import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { FeculentPage } from './feculent.page';

const routes: Routes = [
  {
    path: '',
    component: FeculentPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FeculentPageRoutingModule {}
