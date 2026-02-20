How to Install Flux Pro

1. add the missing package version to the unzipped `composer.json` file:
Code:
{
    "name": "livewire/flux-pro",
    "description": "The pro version of Flux, the official UI component library for Livewire.",
    "keywords": ["flux", "laravel", "livewire", "components", "ui"],
    "version": "2.2.5",   <--- ADD THIS
    ....
}
2. Zip all the files and name the archive `flux-pro-2.2.5.zip` to match the version.
(!) Make sure to zip `src/`, `dist/`, `stubs/`, `composer.json` directly without any root folder.

3. In your Laravel project, create a `packages/` sub-folder and copy your new `flux-pro-2.2.5.zip` file there.

4. Update your Laravel project's `composer.json` by registering a local zip file repository:

Code:
"repositories": [     
    {
        "type": "artifact",
        "url": "./packages"
    }
]

5. Run `composer require livewire/flux-pro` to install and auto-register the package.

https://shopee.co.id/futoruu
https://shopee.co.id/futoruu
https://shopee.co.id/futoruu