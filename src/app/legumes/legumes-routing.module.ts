import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LegumesPage } from './legumes.page';

const routes: Routes = [
  {
    path: '',
    component: LegumesPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LegumesPageRoutingModule {}
