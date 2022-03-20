import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LaitagesPage } from './laitages.page';

const routes: Routes = [
  {
    path: '',
    component: LaitagesPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LaitagesPageRoutingModule {}
