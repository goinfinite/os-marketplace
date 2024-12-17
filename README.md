# Infinite OS Marketplace

This repository stores the installation and uninstallation manifests for all marketplace catalog items supported by [Infinite OS](https://github.com/goinfinite/os).

## Cross-Version Support
This repository is versioned to ensure compatibility with both specific versions of Infinite OS and the `manifestVersion` property found in each manifest. The `manifestVersion` reflects the version of the individual manifest file.

Versioning for this repository is managed through branches, which act as releases. This allows users to clone only the desired branch corresponding to the required version, without the need for actual release tags:

```bash
git clone --single-branch --branch v0 https://github.com/goinfinite/os-marketplace
```

> [!IMPORTANT]
> The versioning of this repository works differently from the Infinite OS versioning. It is important to understand that the versioning here is done through branches and not releases, and its structure also differs from the Infinite OS. The Infinite OS uses major, minor, and patch versions, whereas this repository uses only a single version level, as all changes have significant impacts on the entire marketplace catalog management.

Below is a mapping of repository versions and the respective Infinite OS versions and `manifestVersion` they support:

| Repository branch (version) | Infinite OS version | `manifestVersion` |
| -- | -- | -- |
| `v0` | [`v0.0.1`](https://github.com/goinfinite/os/releases/tag/v0.0.1) [`v0.0.2`](https://github.com/goinfinite/os/releases/tag/v0.0.2) [`v0.0.4`](https://github.com/goinfinite/os/releases/tag/v0.0.4) [`v0.0.6`](https://github.com/goinfinite/os/releases/tag/v0.0.6) [`v0.0.7`](https://github.com/goinfinite/os/releases/tag/v0.0.7)<br/> [`v0.0.9`](https://github.com/goinfinite/os/releases/tag/v0.0.9) [`v0.1.0`](https://github.com/goinfinite/os/releases/tag/v0.1.0) [`v0.1.2`](https://github.com/goinfinite/os/releases/tag/v0.1.2) [`v0.1.5`](https://github.com/goinfinite/os/releases/tag/v0.1.5) | `v1` |

## Manifest/Schema Properties
These manifests have their own property structure, which is read by Infinite OS during the management of these catalog items. The supported formats are JSON (`.json`) and YAML (`.yml`, `.yaml`).

[WordPress example](https://github.com/goinfinite/os-marketplace/blob/main/app/wordpress/manifest.json).

| Property | Type | Is required? | Description |
| -- | -- | -- | -- |
| `manifestVersion` | string | no | _The version of the manifest. This version changes whenever the manifest is updated, indicating the presence of new placeholders or new commands._ |
| `name` | string | yes | _The name of the catalog item that the manifest represents._ |
| `slugs` | []string | no | _Reference names for the catalog item, which can include full names, acronyms, or any identifier related to the catalog item._ |
| `type` | string | yes | _The type of the catalog item, which indicates its purpose._<br/><br/>`app`: _application with their own functionality, such as WordPress._<br/>`framework`: _structured software abstraction providing tools and guidelines for development, such as Laravel._<br/>`stack`: _sets of solutions for building a specialized development and production environment, such as LAMP._ |
| `description` | string | yes | _A description of the catalog item that explains what it is, what it does, and its purpose._ |
| `services` | []string | no | _List of service names that are dependencies for this catalog item, and therefore must be installed. The version can also be provided to ensure the specific version of the dependency to be installed, such as_ `php:8.2`. |
| `mappings` | []object | no | _List of objects that will contain the mapping configurations for this item, allowing them to be created after installation, ensuring the item's access and usage environment is already configured post-installation._<br/><br/>`path`: _route that will be used by the mapping._<br/>`matchPattern`: _comparison pattern that allows webserver to interpret the URL in different ways and ensure the route is properly served._<br/>`targetType`: _what type of mapping it will be, defining what it should do when consumed. Must be_ `url`_,_ `service`, `response-code`_,_ `inline-html` _or_ `static-files`_._<br/>`targetValue`: _value that will be consumed when accessing the mapping. It varies according to the type of mapping._<br/>`targetHttpResponseCode`: _HTTP status code that will be used by the mapping when accessed._<br/><br/>_Only_ `path`_,_ `matchPattern` _and_ `targetType` _are required, while the value and HTTP status code are optional depending on the type. You can create a mapping that redirects to a website with status 200, thus using both the value and HTTP status code at the same time. However, generally, only one of the two is used in most cases._ |
| `dataFields` | []object | no | _List of objects that specify which extra required and/or optional data the user must provide for the installation of the catalog item._<br/><br/>`name`: _Data field's name._<br/>`label`: _Data field's name that will be shown on the frontend interface._<br/>`type`: _Input HTML type, [check here](https://www.w3schools.com/html/html_form_input_types.asp)._<br/>`specificType`: _Subtype used to provide context to the type property. It is only used to generate random values based on the selected subtype. Must be_ `password`_,_ `username` _or_ `email`_._<br/>`defaultValue`: _Default value that will be used if no value is provided by the user during installation. If the `specificType` has been filled and this value does not exist, a new random value will be generated based on the `specificType`._<br/>`options`: _If the_ `type` _is_ `select`_, this property should be filled with all possible selectable values as a list of strings._<br/>`isRequired`: _Determines whether this data field should receive a value or not._<br/><br/>_Only_ `name`_,_ `label` _and_ `type` _and_ `isRequired` _are required._ |
| `installCmdSteps` | []string | no | _Commands to install the catalog item. This is one of the main parts of the manifest, as it contains all the steps required to install dependencies, the catalog item itself, and configure it. This can include editing necessary files, changing file permissions, or using Infinite OS CLI commands when needed._ |
| `uninstallCmdSteps` | []string | no | _Commands to uninstall the already installed catalog item. These steps typically reverse the installation commands, focusing on removing files and extra configurations that will no longer function without the installed catalog item._ |
| `uninstallFileNames` | []string | no | _File names that will be deleted during the uninstallation of the catalog item, which remain in the installation directory, as they are no longer needed._ |
| `estimatedSizeBytes` | string | no | _The estimated size of the catalog item in bytes, providing clarity about the storage impact._ |
| `avatarUrl` | string | yes | _The URL for the catalog item's image, used for illustration purposes._ |
| `screenshotUrls` | []string | no | _List of URL for the catalog item's screenshots, used for static demonstration purposes._ |

## System Data Fields
The system's data fields are predefined values used by Infinite OS to replace placeholders in installation commands. They are similar to the data fields in the manifests themselves, but these are provided by Infinite OS. These placeholders are denoted by `%` at the beginning and end, such as `%adminName%`.

The repository will automatically substitute these placeholders with the appropriate values during the installation process. For example:

```bash
wp core download --path=%installDirectory% --locale=%locale% --allow-root
```

In this example, `%installDirectory%` will be replaced by the installation directory that Infinite OS will define according to the user installing the catalog item.

Below is a table of all available system data fields for creating manifests:

| Name | Type | Description |
| -- | -- | -- |
| `installDirectory` | string | _Path to the directory where all files created by the catalog item installation will be located._ |
| `installUrlPath` | string | _Route that will be exposed to access the installed catalog item._ |
| `installHostname` | string | _tHostname responsible for the installation of the catalog item._ |
| `installUuid` | string | _Unique identifier of the installation. Ideal for file and directory suffixes that will be used only by that installed item._ |
| `installTempDir` | string | _Temporary directory, usually used to store files and directories that will be temporarily used during the installation and discarded once the process is complete._ |
| `installRandomPassword` | string | _Automatically generated password by the system, eliminating the need for manual input._ |
| `marketplaceCatalogItemAssetsDirPath` | string | _Assets directory for the catalog item to be installed. Useful for pre-prepared configuration files ready to be used directly during installation._ |

This substitution also occurs with the data fields added directly in the manifest. The `name` of the data field, when added to a command between `%` as a placeholder, will be replaced by the value of that data field during installation.