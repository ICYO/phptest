#!/bin/env bash
find . -name "*~" | xargs rm -f
rm -f ./static/image/*
