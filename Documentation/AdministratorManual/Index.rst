.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrator Manual
====================

Installation
------------

There are two ways to properly install the extension.

1. Composer installation
^^^^^^^^^^^^^^^^^^^^^^^^

In case you use Composer to manage dependencies of your TYPO3 project,
you can just issue the following Composer command in your project root directory.

.. code-block:: bash

	composer require colorcube/shredder

2. Installation with Extension Manager
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Download and install the extension with the extension manager module.

Customization
-------------

Instead of applying the magic to the whole website it is possible to do that on specific content elements.
Here's a TypoScript example:


::

    // First deactivate the global rendering magic
    shredder = 0

    // activate shredder for text content element
    tt_content.text.stdWrap.postUserFunc = Colorcube\Shredder\Shredder->postUserFunc


    // activate shredder for the login plugin
    plugin.tx_felogin_pi1.stdWrap.postUserFunc = Colorcube\Shredder\Shredder->postUserFunc


Shredder can be applied to any cObject which has the stdWrap property.

This can be very helpful if you want a coworker happy who is woking on a contentn element or a plugin!