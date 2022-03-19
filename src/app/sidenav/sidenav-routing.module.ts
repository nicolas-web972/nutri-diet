import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SidenavPage } from './sidenav.page';

const routes: Routes = [
  {
    path: '',
redirectTo: 'login',
pathMatch: 'full'
},
{
  path: 'nav',
  component:SidenavPage,
  children: [
    {
      path: 'home',
      loadChildren: () => import('../home/home.module').then( m => m.HomePageModule)
    },
    {
      path: 'login',
      loadChildren: () => import('../pages/login/login.module').then( m => m.LoginPageModule)
    },
    {
      path: 'register',
      loadChildren: () => import('../pages/register/register.module').then( m => m.RegisterPageModule)
    },
    {
      path: 'test',
      loadChildren: () => import('../test/test.module').then( m => m.TestPageModule)
    },
    {
      path: 'profile',
      loadChildren: () => import('../pages/profile/profile.module').then( m => m.ProfilePageModule)
    },
    ,
  {
    path: 'logout',
    loadChildren: () => import('../pages/logout/logout.module').then( m => m.LogoutPageModule)
  },
    {
      path: '',
      redirectTo: 'nav/home',
      pathMatch: 'full'
    }
  ]
},
{
  path: '',
  redirectTo: 'nav/home',
  pathMatch: 'full'
}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SidenavPageRoutingModule {}
