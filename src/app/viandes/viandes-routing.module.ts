import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ViandesPage } from './viandes.page';

const routes: Routes = [
  {
    path: '',
    component: ViandesPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ViandesPageRoutingModule {}
