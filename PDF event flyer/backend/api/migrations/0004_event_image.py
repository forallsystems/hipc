# -*- coding: utf-8 -*-
# Generated by Django 1.9.4 on 2016-03-30 11:58
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('api', '0003_auto_20160322_0848'),
    ]

    operations = [
        migrations.AddField(
            model_name='event',
            name='image',
            field=models.TextField(blank=True, null=True),
        ),
    ]
