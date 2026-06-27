### Task 1: Controller Update
Retrieve the system configuration inside `CompanyDashboardController` and pass it to the view.

**Files:**
- Modify: `C:/xampp/htdocs/bolsalaboralv2/app/Http/Controllers/CompanyDashboardController.php`

**Interfaces:**
- Consumes: `system_configuration` table.
- Produces: `$config` variable passed to the `company.dashboard` view.

- [ ] **Step 1: Retrieve and inject $config into CompanyDashboardController**
  
  Replace lines 102-111 of `app/Http/Controllers/CompanyDashboardController.php` to fetch system configurations and pass them to the view.
  
  Code to replace:
  ```php
          return view('company.dashboard', compact(
              'company',
              'offersCount',
              'activeOffersCount',
              'applicantsCount',
              'pendingApplicantsCount',
              'recentOffers',
              'recentApplicants'
          ));
  ```
  with:
  ```php
          $config = DB::table('system_configuration')->pluck('value', 'key')->all();
  
          return view('company.dashboard', compact(
              'company',
              'offersCount',
              'activeOffersCount',
              'applicantsCount',
              'pendingApplicantsCount',
              'recentOffers',
              'recentApplicants',
              'config'
          ));
  ```

- [ ] **Step 2: Commit Task 1**
  
  Run command:
  ```bash
  git add app/Http/Controllers/CompanyDashboardController.php
  git commit -m "feat: pass config database settings to company dashboard view"
  ```

---

