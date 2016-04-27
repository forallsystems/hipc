#!/usr/bin/env python
import os
import sys
import argparse

if __name__ == "__main__":
    """
    Allow --cs option to specify a private settings module.  Assumes that the specified
    settings module is in a directory named 'hipc_ccol_pdf_settings' in the same
    parent directory as this repository.
    """
    settings_module = "api.settings" 

    parser = argparse.ArgumentParser()
    parser.add_argument('--cs', action='store', nargs='?', type=str, required=False) 
    
    (ns, remainder) = parser.parse_known_args()
    if ns.cs:
        settings_module = ns.cs
        settings_dir = os.path.join(
            os.path.dirname(os.path.dirname(os.path.abspath(__file__))),
            '../hipc_ccol_pdf_settings'
        )
        sys.path.append(os.path.normpath(settings_dir))

    os.environ.setdefault("DJANGO_SETTINGS_MODULE", settings_module)

    from django.core.management import execute_from_command_line
    execute_from_command_line(sys.argv[:1]+remainder)
