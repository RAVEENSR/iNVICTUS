from setuptools import setup

setup(
    name='Intelligent Advertising System',
    version='2.0',
    author='Raveen Savinda Rathnayake',
    author_email='raveen.s.r@gmail.com',
    url='https://github.com/RAVEENSAVINDA/ias-rpi-app',
    license='GPLv2',
    description='An intelligent advertising system which can help to boost shop owners income',
    long_description=open('README.md').read(),
    scripts = [ 'bin/mainScript.py','bin/mainwindow.py' ],
    data_files=[
        ('/lib/systemd/system', ['etc/ias.service']),
        ('/etc', ['etc/ias.conf']),
        ('/var/lib/secura_pi_cam', ['etc/billboardLog.log'])
    ],
    install_requires=[
        'PyQt5',
        'pyodbc'
    ],
    classifiers=[
    'Environment :: Console',
        'Operating System :: POSIX',
        'Programming Language :: Python :: 3.4'
    ],
)
