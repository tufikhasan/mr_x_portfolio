<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SeoPropertiesController;
use App\Http\Controllers\SkillController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

//All backend route
Route::middleware( ['auth'] )->group( function () {
    Route::get( '/dashboard', function () {
        $contacts = Contact::latest()->get();
        return view( 'admin.index', compact( 'contacts' ) );
    } )->name( 'dashboard' );

    Route::controller( AdminController::class )->group( function () {
        Route::get( '/user/logout', 'adminLogout' )->name( 'admin.logout' );
        Route::get( '/user/profile', 'adminProfile' )->name( 'admin.profile' );
        Route::get( '/edit/profile/{id}', 'editProfile' )->name( 'edit.profile' );
        Route::post( '/edit/profile', 'updateProfile' )->name( 'update.profile' );
        Route::get( '/change/password', 'changePassword' )->name( 'change.password' );
        Route::patch( '/change/password', 'updatePassword' )->name( 'update.password' );
    } );

    Route::controller( HomeController::class )->group( function () {
        Route::get( '/hero/property', 'getHeroProperty' )->name( 'hero.properties' );
        Route::post( '/hero/property', 'updateHeroProperty' )->name( 'update.heroProperty' )->middleware( 'admin' );

        Route::get( '/about/info', 'aboutInfo' )->name( 'about.info' );
        Route::patch( '/about/info', 'updateAboutInfo' )->name( 'update.about' )->middleware( 'admin' );

        Route::get( '/social/link', 'getSocial' )->name( 'social.link' );
        Route::patch( '/social/link', 'updateSocial' )->name( 'update.social' )->middleware( 'admin' );
    } );

    Route::controller( SeoPropertiesController::class )->group( function () {
        Route::get( '/home/seo', 'homeSeo' )->name( 'home.seo' );
        Route::get( '/about/seo', 'aboutSeo' )->name( 'about.seo' );
        Route::get( '/contact/seo', 'contactSeo' )->name( 'contact.seo' );
        Route::get( '/resume/seo', 'resumeSeo' )->name( 'resume.seo' );
        Route::post( '/update/seo', 'updateSeo' )->name( 'update.seo' )->middleware( 'admin' );
    } );

    Route::controller( SkillController::class )->group( function () {
        Route::get( '/skills', 'getSkill' )->name( 'all.skill' );
        Route::post( '/skills', 'addSkill' )->name( 'add.skill' );
        Route::patch( '/skills', 'updateSkill' )->name( 'update.skill' )->middleware( 'admin' );
        Route::delete( '/skills', 'deleteSkill' )->name( 'delete.skill' )->middleware( 'admin' );
        Route::get( '/skills/skill-data', 'skillPaginate' );
        Route::get( '/skill/search', 'searchSkill' )->name( 'search.skill' );
    } );

    Route::controller( ProjectController::class )->group( function () {
        Route::get( '/projects/list', 'getProject' )->name( 'all.project' );
        Route::post( '/projects', 'addProject' )->name( 'add.project' );
        Route::post( '/update/project', 'updateProject' )->name( 'update.project' )->middleware( 'admin' );
        Route::delete( '/projects', 'deleteProject' )->name( 'delete.project' )->middleware( 'admin' );
        Route::get( '/projects-data', 'projectPaginate' );
        Route::get( '/projects/search', 'searchProject' )->name( 'search.project' );
    } );

    Route::controller( EducationController::class )->group( function () {
        Route::get( '/educations', 'getEducation' )->name( 'all.education' );
        Route::post( '/educations', 'addEducation' )->name( 'add.education' );
        Route::patch( '/educations', 'updateEducation' )->name( 'update.education' )->middleware( 'admin' );
        Route::delete( '/educations', 'deleteEducation' )->name( 'delete.education' )->middleware( 'admin' );
        Route::get( '/educations/education-data', 'educationPaginate' );
        Route::get( '/educations/search', 'searchEducation' )->name( 'search.education' );
    } );

    Route::controller( ExperienceController::class )->group( function () {
        Route::get( '/experiences', 'getExperience' )->name( 'all.experience' );
        Route::post( '/experiences', 'addExperience' )->name( 'add.experience' );
        Route::patch( '/experiences', 'updateExperience' )->name( 'update.experience' )->middleware( 'admin' );
        Route::delete( '/experiences', 'deleteExperience' )->name( 'delete.experience' )->middleware( 'admin' );
        Route::get( '/experiences/experience-data', 'experiencePaginate' );
        Route::get( '/experiences/search', 'searchExperience' )->name( 'search.experience' );
    } );

    Route::controller( LanguageController::class )->group( function () {
        Route::get( '/languages', 'getLanguage' )->name( 'all.language' );
        Route::post( '/languages', 'addLanguage' )->name( 'add.language' );
        Route::patch( '/languages', 'updateLanguage' )->name( 'update.language' )->middleware( 'admin' );
        Route::delete( '/languages', 'deleteLanguage' )->name( 'delete.language' )->middleware( 'admin' );
        Route::get( '/languages/language-data', 'languagePaginate' );
        Route::get( '/languages/search', 'searchlanguage' )->name( 'search.language' );
    } );
    Route::get( '/resume/link', [ResumeController::class, 'resumeLink'] )->name( 'resume.link' );
    Route::post( '/resume/link', [ResumeController::class, 'updateResume'] )->name( 'update.resume' )->middleware( 'admin' );
} );

//Frontend web page all route
Route::get( '/', [HomeController::class, 'page'] )->name( 'home.page' );
Route::get( '/projects', [ProjectController::class, 'page'] )->name( 'project.page' );
Route::get( '/contact', [ContactController::class, 'page'] )->name( 'contact.page' );
Route::get( '/resume', [ResumeController::class, 'page'] )->name( 'resume.page' );

//Ajax call routes
Route::get( '/heroData', [HomeController::class, 'heroData'] );
Route::get( '/aboutData', [HomeController::class, 'aboutData'] );
Route::get( '/socialData', [HomeController::class, 'socialData'] );

Route::get( '/resumeData', [ResumeController::class, 'resumeData'] );
Route::get( '/experienceData', [ResumeController::class, 'experienceData'] );
Route::get( '/educationData', [ResumeController::class, 'educationData'] );
Route::get( '/skillData', [ResumeController::class, 'skillData'] );
Route::get( '/languageData', [ResumeController::class, 'languageData'] );

Route::get( '/projectData', [ProjectController::class, 'projectData'] );

Route::post( '/storeContact', [ContactController::class, 'storeContact'] );

require __DIR__ . '/auth.php';
