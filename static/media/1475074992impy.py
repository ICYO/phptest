#!/bin/env python3
import os
import imghdr
from PIL import Image
jpglst = []

def JpgToPng() -> list:
    pnglst = []
    for i in os.listdir():
        if imghdr.what( i ) == 'jpeg':
# (1) save jpeg files to list (jpglst) ->
            jpglst.append( i )
# (2) change jpg to png and view to user ->
            onepng = i.split('.jpg')[0]+'.png'
            im = Image.open( i ).save( onepng )
            print( 'make {0} --> {1}'.format( i, onepng ) )
# (3) make the png list ->
            pnglst.append( onepng )

        else: # if any file are not jpeg file ->
            print(i,' is not picture')
    return pnglst


def AskToDel() -> None:
    ask = input('if you want to delete all jpeg files? y/n: ')
    if ask == 'y':
        for i in jpglst:
            os.remove( i )
            print(i, ' is removed.')
    elif ask =='n':
        print('no file will be remove.')
    else:
        print('Wrong inputs')
        AskToDel()

# =================== RUN ===================

if __name__ == '__main__':
    print('all jpeg files will be change to png')
    JpgToPng()
    AskToDel()
    print('done')
